import 'package:webdirapp/screens/person_provider.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'web_dir_app.dart';

Future<void> main() async {

  WidgetsFlutterBinding.ensureInitialized();

  runApp(ChangeNotifierProvider(
    create: (context) => PersonProvider(),
    child: const WebDirApp(),
  ),
  );
}

