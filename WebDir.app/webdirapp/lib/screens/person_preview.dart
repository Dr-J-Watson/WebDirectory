import 'package:flutter/material.dart';
import 'package:webdirapp/models/person.dart';
import 'package:webdirapp/screens/person_provider.dart';

class PersonPreview extends StatefulWidget {
  final Person person;
  final PersonProvider personProvider;

  PersonPreview({required this.person, required this.personProvider});

  @override
  _PersonPreviewState createState() => _PersonPreviewState();
}

class _PersonPreviewState extends State<PersonPreview> {
  @override
  Widget build(BuildContext context) {
    return Card(
      child: ListTile(
        leading: CircleAvatar(
          backgroundImage: widget.person.image != null
              ? NetworkImage(widget.person.image!)
              : null,
        ),
        title: Text('${widget.person.firstName} ${widget.person.lastName}'),
        subtitle: Text(widget.person.numBureau),
      ),
    );
  }
}

