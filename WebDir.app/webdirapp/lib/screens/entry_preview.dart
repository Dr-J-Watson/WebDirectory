import 'package:flutter/material.dart';
import 'package:webdirapp/models/entry.dart';
import 'package:webdirapp/screens/entry_provider.dart';
import 'package:webdirapp/screens/entry_details.dart';

class EntryPreview extends StatefulWidget {
  final Entry entry;
  final EntryProvider entryProvider;

  EntryPreview({required this.entry, required this.entryProvider});

  @override
  _EntryPreviewState createState() => _EntryPreviewState();
}

class _EntryPreviewState extends State<EntryPreview> {
  @override
  Widget build(BuildContext context) {
    return Card(
      color: Colors.white,
      child:GestureDetector(
      child: ListTile(
        leading: CircleAvatar(
          backgroundImage: widget.entry.image != null
              ? NetworkImage(widget.entry.image!)
              : null,
          child: widget.entry.image == null
              ? Text(widget.entry.firstName[0] + widget.entry.lastName[0])
              : null,
        ),
        title: Text('${widget.entry.firstName} ${widget.entry.lastName.toUpperCase()}'),
        subtitle: Text('Départements : ${widget.entry.departements.join(', ')}'),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(10.0),
          //side: const BorderSide(color: Color.fromARGB(255, 158, 158, 158), width: 1.0),
        ),
        trailing: const Icon(Icons.arrow_forward_ios),
      ),
      onTap: () {
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => EntryDetails(entry: widget.entry),
          ),
        );
      },
    ),
    );
  }
}

